import React, { Fragment } from "react";
import PageTitle from "../../components/common/dashboard/PageTitle";
import ThinCard from "./../../components/UI/cards/ThinCard";
import { useLoaderData } from "react-router-dom";
import CourseForm from "../../components/course/CourseForm";

function CreateCoursePage() {
  const data = useLoaderData();
  return (
    <Fragment>
      <PageTitle pageTitle="Tableau de bord" currentPage="Tableau de bord" />
      <ThinCard title="Nouveau cours">
        <CourseForm
          method="POST"
          groups={data.groups}
          subjects={data.subjects}
        />
      </ThinCard>
    </Fragment>
  );
}

export default CreateCoursePage;
