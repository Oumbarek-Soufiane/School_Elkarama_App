import React, { Fragment } from "react";
import PageTitle from "../../components/common/dashboard/PageTitle";
import ThinCard from "./../../components/UI/cards/ThinCard";
import AdminForm from './../../components/admin/AdminForm';

function CreateAdminPage() {
  return (
    <Fragment>
      <PageTitle pageTitle="Tableau de bord" currentPage="Tableau de bord" />
      <ThinCard title="Nouveau administrateur">
        <AdminForm method="POST" />
      </ThinCard>
    </Fragment>
  );
}

export default CreateAdminPage;
