import React, { Fragment } from "react";
import PageTitle from "../../components/common/dashboard/PageTitle";
import ThinCard from "./../../components/UI/cards/ThinCard";
import { useLoaderData } from "react-router-dom";
import GoupDetails from "../../components/group/GoupDetails";

function GroupDetailsPage() {
  const data = useLoaderData();
  console.log(data);
  return (
    <Fragment>
      <PageTitle pageTitle="Tableau de bord" currentPage="Tableau de bord" />
      <ThinCard title="Nouveau groupe">
        <GoupDetails group={data.group} students={data.students} />
      </ThinCard>
    </Fragment>
  );
}

export default GroupDetailsPage;
