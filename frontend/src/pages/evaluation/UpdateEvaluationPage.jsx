import React, { Fragment } from "react";
import PageTitle from "../../components/common/dashboard/PageTitle";
import ThinCard from "./../../components/UI/cards/ThinCard";
import EvaluationForm from "../../components/evaluation/EvaluationForm";
import { useLoaderData } from "react-router-dom";

function UpdateEvaluationPage() {
  const data = useLoaderData();
  return (
    <Fragment>
      <PageTitle pageTitle="Tableau de bord" currentPage="Tableau de bord" />
      <ThinCard title="Modifier evaluation">
        <EvaluationForm
          method="POST"
          levels={data.levels}
          teachers={data.teachers}
          evaluation={data.evaluation}
        />
      </ThinCard>
    </Fragment>
  );
}

export default UpdateEvaluationPage;
