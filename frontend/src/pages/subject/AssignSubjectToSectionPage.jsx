import React, { Fragment } from "react";
import PageTitle from "../../components/common/dashboard/PageTitle";
import ThinCard from "./../../components/UI/cards/ThinCard";
import AssignSubjectForm from "../../components/subject/AssignSubjectForm";
import { useLoaderData } from "react-router-dom";

function AssignSubjectToSectionPage() {
  const data = useLoaderData();

  return (
    <Fragment>
      <PageTitle pageTitle="Tableau de bord" currentPage="Tableau de bord" />
      <ThinCard title="Nouvelle année scolaire">
        <AssignSubjectForm method="POST" levels={data.levels} subjects={data.subjects} />
      </ThinCard>
    </Fragment>
  );
}

export default AssignSubjectToSectionPage;
