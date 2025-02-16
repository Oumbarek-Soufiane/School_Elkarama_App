import React, { Fragment } from "react";
import PageTitle from "../../components/common/dashboard/PageTitle";
import ThinCard from "./../../components/UI/cards/ThinCard";
import { useLoaderData } from "react-router-dom";
import AssignTeacherForm from "../../components/group/AssignTeacherForm";

function AssignTeacherToGroupPage() {
  const data = useLoaderData();
  
  return (
    <Fragment>
      <PageTitle pageTitle="Tableau de bord" currentPage="Tableau de bord" />
      <ThinCard title="Affctation des etudiant au groupe">
        <AssignTeacherForm method="POST" groups={data.groups} />
      </ThinCard>
    </Fragment>
  );
}

export default AssignTeacherToGroupPage;
