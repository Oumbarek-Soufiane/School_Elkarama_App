import React, { Fragment } from "react";
import { useLoaderData } from "react-router-dom";
import PageTitle from "../../components/common/dashboard/PageTitle";
import ThinCard from "../../components/UI/cards/ThinCard";
import AdminForm from './../../components/admin/AdminForm';

function UpdateAdminPage() {
  const data = useLoaderData();
 
  return (
    <Fragment>
      <PageTitle pageTitle="Tableau de bord" currentPage="Tableau de bord" />
      <ThinCard title="Modifier Professeur">
        <AdminForm method="PUT" admin={data.admin} />
      </ThinCard>
    </Fragment>
  );
}

export default UpdateAdminPage;
