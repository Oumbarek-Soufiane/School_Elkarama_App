import React, { Fragment } from "react";
import PageTitle from "../../components/common/dashboard/PageTitle";
import ThinCard from "./../../components/UI/cards/ThinCard";
import ClassRoomForm from "../../components/class-room/ClassRoomForm";
import { useLoaderData } from "react-router-dom";

function UpdateClassRoomPage() {
  const data = useLoaderData();

  return (
    <Fragment>
      <PageTitle pageTitle="Tableau de bord" currentPage="Tableau de bord" />
      <ThinCard title="Modifier salle">
        <ClassRoomForm method="PUT" room={data.room} />
      </ThinCard>
    </Fragment>
  );
}

export default UpdateClassRoomPage;
