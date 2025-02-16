import axios from "axios";
import { toast } from "react-toastify";
import { redirect } from "react-router-dom";
import { AppURL } from "./../../apis/AppURL";
import { checkAuthLoader, getAuthToken, getUserType } from "../loaders";
import { validateEmail } from "../validations";

export async function authAction({ request }) {
  const url = new URL(request.url);
  const user = url.searchParams.get("user");
  let LoginUrl = AppURL.userLogin(user);

  const formData = await request.formData();
  const email = formData.get("email");
  const password = formData.get("password");

  if(!validateEmail(email)){
    toast.error("Email format incorrect");
    return null;
  }

  const authData = {
    email: email,
    password: password,
  };

  try {
    const response = await axios.post(LoginUrl, authData, {
      headers: {
        "Content-Type": "application/json",
      },
    });

    const token = response.data.token;

    if (process.env.NODE_ENV === "development") {
      document.cookie = `authToken=${token};`;
      document.cookie = `user_type=${user}`;
    } else {
      document.cookie = `authToken=${token}; secure; HttpOnly`;
      document.cookie = `user_type=${user}`;
    }

    return redirect(`/${user}/dashboard`);
  } catch (error) {
    if (error.response && error.response.data) {
      toast.error(error.response.data.message);
      console.log(error.response.data);
      return {
        message: error.response.data.message,
        status: error.response.status,
      };
    } else {
      toast.error("Une erreur est survenue lors de la connexion.");
      console.log(error);
      return {
        message: "Une erreur est survenue lors de la connexion.",
        status: 500,
      };
    }
  }
}

export const logout = async () => {
  try {
    const token = getAuthToken();
    const userType = getUserType();

    const response = await axios.post(
      AppURL.userLogout(userType),
      {},
      {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      }
    );
    document.cookie =
      "authToken=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    document.cookie =
      "user_type=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    await checkAuthLoader();
    return response.data.message;
  } catch (error) {
    console.error("Erreur de déconnexion:", error);
    throw new Error("Erreur de déconnexion");
  }
};
