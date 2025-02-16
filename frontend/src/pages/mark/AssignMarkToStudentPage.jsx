import React, { Fragment } from "react";
import { useLoaderData } from "react-router-dom";
import PageTitle from "../../components/common/dashboard/PageTitle";
import ThinCard from "./../../components/UI/cards/ThinCard";
import StudentMarkForm from "../../components/mark/StudentMarkForm";

function AssignMarkToStudentPage() {
  const data = useLoaderData();

  return (
    <Fragment>
      <PageTitle pageTitle="Tableau de bord" currentPage="Tableau de bord" />
      <ThinCard title="Affecter Notes">
        <StudentMarkForm
          method="POST"
          groups={data.groups}
          subjects={data.subjects}
          evaluations={data.evaluations}
        />
      </ThinCard>
    </Fragment>
  );
}

export default AssignMarkToStudentPage;
