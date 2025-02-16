import React, { Fragment, useEffect } from "react";
import { useLoaderData } from "react-router-dom";
import { ToastContainer, toast } from "react-toastify";
import { useDispatch, useSelector } from "react-redux";
import PageTitle from "../../components/common/dashboard/PageTitle";
import ThinCard from "../../components/UI/cards/ThinCard";
import { clearSuccessMessage } from "../../redux/slices/successMessageSlice";
import TeacherList from './../../components/teacher/TeacherList';

function TeacherListPage() {
  const data = useLoaderData();
  const dispatch = useDispatch();
  const successMessage = useSelector((state) => state.successMessage.message);
console.log(data);
  useEffect(() => {
    if (successMessage) {
      toast.success(successMessage);
      dispatch(clearSuccessMessage());
    }
  }, [successMessage, dispatch]);

  return (
    <Fragment>
      <ToastContainer />
      <PageTitle pageTitle="Tableau de bord" currentPage="Tableau de bord" />
      <ThinCard title="La liste professeurs">
        <TeacherList teachers={data.teachers} />
      </ThinCard>
    </Fragment>
  );
}

export default TeacherListPage;
