import React, { Fragment } from "react";
import PageTitle from "../../components/common/dashboard/PageTitle";
import ThinCard from "./../../components/UI/cards/ThinCard";
import { useLoaderData } from "react-router-dom";
import CourseForm from "../../components/course/CourseForm";

function UpdateCoursePage() {
  const data = useLoaderData();
  return (
    <Fragment>
      <PageTitle pageTitle="Tableau de bord" currentPage="Tableau de bord" />
      <ThinCard title="Nouveau cours">
        <CourseForm
          method="PUT"
          groups={data.groups}
          subjects={data.subjects}
          course={data.course}
        />
      </ThinCard>
    </Fragment>
  );
}

export default UpdateCoursePage;
