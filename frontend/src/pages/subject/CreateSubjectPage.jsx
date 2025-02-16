import React, { Fragment } from "react";
import PageTitle from "../../components/common/dashboard/PageTitle";
import ThinCard from "./../../components/UI/cards/ThinCard";
import SubjectForm from "../../components/subject/SubjectForm";

function CreateSubjectPage() {
  return (
    <Fragment>
      <PageTitle pageTitle="Tableau de bord" currentPage="Tableau de bord" />
      <ThinCard title="Nouvelle année scolaire">
        <SubjectForm method="POST" />
      </ThinCard>
    </Fragment>
  );
}

export default CreateSubjectPage;
