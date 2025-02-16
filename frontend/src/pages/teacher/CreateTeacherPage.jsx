import React, { Fragment } from "react";
import PageTitle from "../../components/common/dashboard/PageTitle";
import ThinCard from "./../../components/UI/cards/ThinCard";
import TeacherForm from "./../../components/teacher/TeacherForm";
import { useLoaderData } from "react-router-dom";

function CreateTeacherPage() {
  const data = useLoaderData();
  return (
    <Fragment>
      <PageTitle pageTitle="Tableau de bord" currentPage="Tableau de bord" />
      <ThinCard title="Nouveau professeur">
        <TeacherForm method="POST" subjects={data.subjects} />
      </ThinCard>
    </Fragment>
  );
}

export default CreateTeacherPage;
