import React, { Fragment } from "react";
import { useLoaderData } from "react-router-dom";
import PageTitle from "../../components/common/dashboard/PageTitle";
import ThinCard from "./../../components/UI/cards/ThinCard";
import StudentAbsenceForm from "./../../components/absences/StudentAbsenceForm";

function StudentAbsencePage() {
  const data = useLoaderData();
  return (
    <Fragment>
      <PageTitle pageTitle="Tableau de bord" currentPage="Tableau de bord" />
      <ThinCard title="La liste Eleves">
        <StudentAbsenceForm
          method="POST"
          groups={data.groups}
          subjects={data.subjects}
        />
      </ThinCard>
    </Fragment>
  );
}

export default StudentAbsencePage;
