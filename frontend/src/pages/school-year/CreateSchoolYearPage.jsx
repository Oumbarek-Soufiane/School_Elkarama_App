import React, { Fragment } from "react";
import SchoolYearForm from "../../components/school-year/SchoolYearForm";
import PageTitle from "../../components/common/dashboard/PageTitle";
import ThinCard from "./../../components/UI/cards/ThinCard";

function CreateSchoolYearPage() {
  return (
    <Fragment>
      <PageTitle pageTitle="Tableau de bord" currentPage="Tableau de bord" />
      <ThinCard title="Nouvelle année scolaire">
        <SchoolYearForm method="POST" />
      </ThinCard>
    </Fragment>
  );
}

export default CreateSchoolYearPage;
