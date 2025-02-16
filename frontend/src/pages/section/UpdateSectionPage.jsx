import React, { Fragment } from "react";
import { useLoaderData } from "react-router-dom";
import PageTitle from "../../components/common/dashboard/PageTitle";
import ThinCard from "../../components/UI/cards/ThinCard";
import SectionForm from "../../components/section/SectionForm";

function UpdateSectionPage() {
  const data = useLoaderData();
  return (
    <Fragment>
      <PageTitle pageTitle="Tableau de bord" currentPage="Tableau de bord" />
      <ThinCard title="Modifier une année scolaire">
        <SectionForm method="PUT" levels={data.levels} section={data.section} />
      </ThinCard>
    </Fragment>
  );
}

export default UpdateSectionPage;
