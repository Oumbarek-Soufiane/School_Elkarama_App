import React, { Fragment, useEffect } from "react";
import PageTitle from "../../../components/common/dashboard/PageTitle";
import ThinCard from "../../../components/UI/cards/ThinCard";

import { useLoaderData } from "react-router-dom";
import { ToastContainer, toast } from "react-toastify";
import { useDispatch, useSelector } from "react-redux";
import { clearSuccessMessage } from "../../../redux/slices/successMessageSlice";
import StaffList from "../../../components/transport/staff/StaffList";

function TransportStaffListPage() {
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
      <ThinCard title="La liste des buses">
        <StaffList staff={data.staff} />
      </ThinCard>
    </Fragment>
  );
}

export default TransportStaffListPage;

