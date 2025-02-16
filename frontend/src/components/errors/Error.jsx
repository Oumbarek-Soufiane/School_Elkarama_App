import { useEffect, useState, useMemo } from "react";
import { useRouteError, Link } from "react-router-dom";
import classes from "./Error.module.css";
import { checkAuthLoader, getUserType } from "../../utils/loaders";

function useAuthStatus() {
  const [connected, setConnected] = useState(false);

  useEffect(() => {
    const checkAuthStatus = async () => {
      try {
        const result = await checkAuthLoader();
        setConnected(result === null);
      } catch (error) {
        console.error("Error checking auth status", error);
        setConnected(false);
      }
    };

    checkAuthStatus();
  }, []);

  return connected;
}

function Error() {
  const connected = useAuthStatus();
  const userType = getUserType();
  const error = useRouteError();

  const { status, data } = error || {};
  const { title, message } = useMemo(() => {
    let title = "Une erreur s'est produite !";
    let message = "Quelque chose s'est mal passé !";

    if (status === 500 && data?.message) {
      message = data.message;
    }

    if (status === 404) {
      title = "Page non trouvée !";
      message = "La ressource ou la page demandée est introuvable.";
    }

    return { title, message };
  }, [status, data]);

  return (
    <div className={classes.container}>
      <h1>{status}</h1>
      <h3 className={classes.title}>{title}</h3>
      <p className={classes.message}>{message}</p>
      <Link to={connected ? `/${userType}/dashboard` : "/"} className={classes.link}>
        {connected ? "Retour au tableau de bord" : "Retour à la page d'accueil"}
      </Link>
    </div>
  );
}

export default Error;
