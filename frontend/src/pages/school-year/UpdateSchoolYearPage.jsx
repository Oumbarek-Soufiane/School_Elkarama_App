import React, { Fragment } from "react";
import SchoolYearForm from "../../components/school-year/SchoolYearForm";
import { useLoaderData } from "react-router-dom";
import PageTitle from "../../components/common/dashboard/PageTitle";
import ThinCard from "../../components/UI/cards/ThinCard";

function UpdateSchoolYearPage() {
  const data = useLoaderData();
  return (
    <Fragment>
      <PageTitle pageTitle="Tableau de bord" currentPage="Tableau de bord" />
      <ThinCard title="Modifier une année scolaire">
        <SchoolYearForm method="PUT" year={data.year} />
      </ThinCard>
    </Fragment>
  );
}

export default UpdateSchoolYearPage;
