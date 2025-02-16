import React, { Fragment } from "react";
import PageTitle from "../../components/common/dashboard/PageTitle";
import ThinCard from "./../../components/UI/cards/ThinCard";
import { useLoaderData } from "react-router-dom";
import AssignStudentForm from "../../components/group/AssignStudentForm";

function AssignStudentToGroupPage() {
  const data = useLoaderData();
  
  return (
    <Fragment>
      <PageTitle pageTitle="Tableau de bord" currentPage="Tableau de bord" />
      <ThinCard title="Affctation au groupe">
        <AssignStudentForm method="POST" groups={data.groups} />
      </ThinCard>
    </Fragment>
  );
}

export default AssignStudentToGroupPage;
