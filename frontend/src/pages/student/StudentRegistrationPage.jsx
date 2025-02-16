import React, { Fragment } from "react";
import PageTitle from "../../components/common/dashboard/PageTitle";
import ThinCard from "./../../components/UI/cards/ThinCard";
import RegistrationForm from "./../../components/student/RegistrationForm";

function StudentRegistrationPage() {
  return (
    <Fragment>
      <PageTitle pageTitle="Tableau de bord" currentPage="Tableau de bord" />
      <ThinCard title="Nouvelle Inscription">
        <RegistrationForm />
      </ThinCard>
    </Fragment>
  );
}

export default StudentRegistrationPage;
