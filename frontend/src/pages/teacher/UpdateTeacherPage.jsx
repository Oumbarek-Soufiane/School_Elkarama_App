import React, { Fragment } from "react";
import { useLoaderData } from "react-router-dom";
import PageTitle from "../../components/common/dashboard/PageTitle";
import ThinCard from "../../components/UI/cards/ThinCard";
import TeacherForm from "./../../components/teacher/TeacherForm";

function UpdateTeacherPage() {
  const data = useLoaderData();
  console.log(data)
  return (
    <Fragment>
      <PageTitle pageTitle="Tableau de bord" currentPage="Tableau de bord" />
      <ThinCard title="Modifier Professeur">
        <TeacherForm
          method="PUT"
          subjects={data.subjects}
          teacher={data.teacher}
        />
      </ThinCard>
    </Fragment>
  );
}

export default UpdateTeacherPage;
