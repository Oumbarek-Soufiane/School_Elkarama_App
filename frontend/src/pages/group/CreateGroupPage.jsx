import React, { Fragment } from "react";
import PageTitle from "../../components/common/dashboard/PageTitle";
import ThinCard from "./../../components/UI/cards/ThinCard";
import { useLoaderData } from "react-router-dom";
import GroupForm from "../../components/group/GroupForm";

function CreateGroupPage() {
  const data = useLoaderData();
  return (
    <Fragment>
      <PageTitle pageTitle="Tableau de bord" currentPage="Tableau de bord" />
      <ThinCard title="Nouveau groupe">
        <GroupForm method="POST" sections={data.sections} />
      </ThinCard>
    </Fragment>
  );
}

export default CreateGroupPage;
