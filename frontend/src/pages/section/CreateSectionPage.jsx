import React, { Fragment } from "react";
import PageTitle from "../../components/common/dashboard/PageTitle";
import ThinCard from "./../../components/UI/cards/ThinCard";
import SectionForm from "../../components/section/SectionForm";
import { useLoaderData } from "react-router-dom";

function CreateSectionPage() {
    const data = useLoaderData();
  return (
    <Fragment>
      <PageTitle pageTitle="Tableau de bord" currentPage="Tableau de bord" />
      <ThinCard title="Nouvelle année scolaire">
        <SectionForm method="POST" levels={data.levels}/>
      </ThinCard>
    </Fragment>
  );
}

export default CreateSectionPage;
