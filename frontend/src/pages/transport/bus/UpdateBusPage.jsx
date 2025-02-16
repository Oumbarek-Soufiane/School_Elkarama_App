import React, { Fragment } from "react";
import PageTitle from "./../../../components/common/dashboard/PageTitle";
import ThinCard from "./../../../components/UI/cards/ThinCard";
import BusForm from "../../../components/transport/bus/BusForm";
import { useLoaderData } from "react-router-dom";

function UpdateBusPage() {
    const data = useLoaderData();
  return (
    <Fragment>
      <PageTitle pageTitle="Tableau de bord" currentPage="Tableau de bord" />
      <ThinCard title="Modifier bus">
        <BusForm method="PUT" bus={data.bus} />
      </ThinCard>
    </Fragment>
  );
}

export default UpdateBusPage;
