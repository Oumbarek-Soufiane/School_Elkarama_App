import React, { Fragment } from "react";
import PageTitle from "../../components/common/dashboard/PageTitle";
import ThinCard from "./../../components/UI/cards/ThinCard";
import ClassRoomForm from "../../components/class-room/ClassRoomForm";

function CreateClassRoomPage() {
  return (
    <Fragment>
      <PageTitle pageTitle="Tableau de bord" currentPage="Tableau de bord" />
      <ThinCard title="Nouvelle salle">
        <ClassRoomForm method="POST" />
      </ThinCard>
    </Fragment>
  );
}

export default CreateClassRoomPage;
