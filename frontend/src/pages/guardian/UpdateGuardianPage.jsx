import React, { Fragment } from "react";
import PageTitle from "../../components/common/dashboard/PageTitle";
import ThinCard from "./../../components/UI/cards/ThinCard";
import { useLoaderData } from "react-router-dom";
import GuardianForm from "../../components/guardian/GuardianForm";
function UpdateGuardianPage() {
  const data = useLoaderData();

  return (
    <Fragment>
      <PageTitle pageTitle="Tableau de bord" currentPage="Tableau de bord" />
      <ThinCard title="Modifier evaluation">
        <GuardianForm method="PUT" guardian={data.guardian} />
      </ThinCard>
    </Fragment>
  );
}

export default UpdateGuardianPage;
