import React, { Fragment } from "react";
import { useLoaderData } from "react-router-dom";
import PageTitle from "../../components/common/dashboard/PageTitle";
import ThinCard from "./../../components/UI/cards/ThinCard";
import UpdateStudentForm from "../../components/student/UpdateStudentForm";

function UpdateStudentPage() {
  const data = useLoaderData();
 
  return (
    <Fragment>
      <PageTitle pageTitle="Tableau de bord" currentPage="Tableau de bord" />
      <ThinCard title="Nouvelle année scolaire">
        <UpdateStudentForm method="PUT" groups={data.groups} student={data.student} />
      </ThinCard>
    </Fragment>
  );
}

export default UpdateStudentPage;
