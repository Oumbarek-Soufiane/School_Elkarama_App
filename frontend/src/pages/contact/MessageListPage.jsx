import { Fragment, useEffect } from "react";
import { ToastContainer, toast } from "react-toastify";
import PageTitle from "../../components/common/dashboard/PageTitle";
import ThinCard from "../../components/UI/cards/ThinCard";
import { clearSuccessMessage } from "../../redux/slices/successMessageSlice";
import { useLoaderData } from "react-router-dom";
import { useDispatch, useSelector } from "react-redux";
import ContactList from "../../components/contact/ContactList";

function MessageListPage() {
  const data = useLoaderData();
  console.log(data);
  const dispatch = useDispatch();
  const successMessage = useSelector((state) => state.successMessage.message);

  useEffect(() => {
    if (successMessage) {
      toast.success(successMessage);
      dispatch(clearSuccessMessage());
    }
  }, [successMessage, dispatch]);

  return (
    <Fragment>
      <ToastContainer />
      <PageTitle pageTitle="Tableau de bord" currentPage="Tableau de bord" />
      <ThinCard title="La liste des salles">
        <ContactList contacts={data.contacts} />
      </ThinCard>
    </Fragment>
  );
}

export default MessageListPage;
