import React, { Fragment } from "react";
import PageTitle from "./../../../components/common/dashboard/PageTitle";
import ThinCard from "./../../../components/UI/cards/ThinCard";
import StaffForm from "./../../../components/transport/staff/StaffForm";
import { useLoaderData } from "react-router-dom";

function CreateTransportStaffPage() {
  const data = useLoaderData();
  return (
    <Fragment>
      <PageTitle pageTitle="Tableau de bord" currentPage="Tableau de bord" />
      <ThinCard title="Nouveau bus">
        <StaffForm method="POST" buses={data.buses} />
      </ThinCard>
    </Fragment>
  );
}

export default CreateTransportStaffPage;

