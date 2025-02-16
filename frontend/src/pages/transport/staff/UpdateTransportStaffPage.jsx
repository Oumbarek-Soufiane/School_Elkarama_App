import React, { Fragment } from "react";
import PageTitle from "./../../../components/common/dashboard/PageTitle";
import ThinCard from "./../../../components/UI/cards/ThinCard";
import StaffForm from "./../../../components/transport/staff/StaffForm";
import { useLoaderData } from "react-router-dom";

function UpdateTransportStaffPage() {
  const data = useLoaderData();
  return (
    <Fragment>
      <PageTitle pageTitle="Tableau de bord" currentPage="Tableau de bord" />
      <ThinCard title="Nouveau bus">
        <StaffForm method="PUT" buses={data.buses} staff={data.staff} />
      </ThinCard>
    </Fragment>
  );
}

export default UpdateTransportStaffPage;

