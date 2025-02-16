import React, { Fragment, useEffect } from "react";
import { useLoaderData } from "react-router-dom";
import { ToastContainer, toast } from "react-toastify";
import { useDispatch, useSelector } from "react-redux";
import PageTitle from "../../components/common/dashboard/PageTitle";
import ThinCard from "../../components/UI/cards/ThinCard";
import { clearSuccessMessage } from "../../redux/slices/successMessageSlice";
import SectionList from "../../components/section/SectionList";

function SectionListPage() {
  const data = useLoaderData();
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
      <ThinCard title="La liste des années scolaires">
        <SectionList sections={data.sections} />
      </ThinCard>
    </Fragment>
  );
}

export default SectionListPage;
