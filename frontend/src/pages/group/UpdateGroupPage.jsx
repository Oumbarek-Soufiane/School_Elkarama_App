import React, { Fragment } from "react";
import { useLoaderData } from "react-router-dom";
import PageTitle from "../../components/common/dashboard/PageTitle";
import ThinCard from "../../components/UI/cards/ThinCard";
import GroupForm from "../../components/group/GroupForm";

function UpdateGroupPage() {
  const data = useLoaderData();
  return (
    <Fragment>
      <PageTitle pageTitle="Tableau de bord" currentPage="Tableau de bord" />
      <ThinCard title="Modifier un groupe">
        <GroupForm method="PUT" sections={data.sections} group={data.group} />
      </ThinCard>
    </Fragment>
  );
}

export default UpdateGroupPage;