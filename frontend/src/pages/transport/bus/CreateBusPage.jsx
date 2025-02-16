import React, { Fragment } from "react";
import PageTitle from "./../../../components/common/dashboard/PageTitle";
import ThinCard from "./../../../components/UI/cards/ThinCard";
import BusForm from "../../../components/transport/bus/BusForm";


function CreatBusPage() {
  return (
    <Fragment>
      <PageTitle pageTitle="Tableau de bord" currentPage="Tableau de bord" />
      <ThinCard title="Nouveau bus">
        <BusForm method="POST" />
      </ThinCard>
    </Fragment>
  );
}

export default CreatBusPage;
