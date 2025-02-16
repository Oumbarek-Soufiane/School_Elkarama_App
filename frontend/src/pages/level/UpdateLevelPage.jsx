import React, { Fragment } from "react";
import PageTitle from "../../components/common/dashboard/PageTitle";
import ThinCard from "./../../components/UI/cards/ThinCard";
import LevelForm from "../../components/level/LevelForm";
import { useLoaderData } from "react-router-dom";

function UpdateLevelPage() {
  const data = useLoaderData();

  return (
    <Fragment>
      <PageTitle pageTitle="Tableau de bord" currentPage="Tableau de bord" />
      <ThinCard title="Modifier une année scolaire">
        <LevelForm method="PUT" level={data.level} />
      </ThinCard>
    </Fragment>
  );
}

export default UpdateLevelPage;
