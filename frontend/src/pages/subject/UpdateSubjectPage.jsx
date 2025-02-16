import React, { Fragment } from "react";
import PageTitle from "../../components/common/dashboard/PageTitle";
import ThinCard from "./../../components/UI/cards/ThinCard";
import SubjectForm from "../../components/subject/SubjectForm";
import { useLoaderData } from "react-router-dom";

function UpdateSubjectPage() {
  const data = useLoaderData();
  return (
    <Fragment>
      <PageTitle pageTitle="Tableau de bord" currentPage="Tableau de bord" />
      <ThinCard title="Nouvelle année scolaire">
        <SubjectForm method="PUT" subject={data.subject} />
      </ThinCard>
    </Fragment>
  );
}

export default UpdateSubjectPage;
