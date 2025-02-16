import React, { Fragment } from "react";
import PageTitle from "../../components/common/dashboard/PageTitle";
import ThinCard from "./../../components/UI/cards/ThinCard";
import LevelForm from "../../components/level/LevelForm";

function CreateLevelPage() {
  return (
    <Fragment>
      <PageTitle pageTitle="Tableau de bord" currentPage="Tableau de bord" />
      <ThinCard title="Nouvelle année scolaire">
        <LevelForm method="POST" />
      </ThinCard>
    </Fragment>
  );
}

export default CreateLevelPage;