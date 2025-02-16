import React, { Fragment, useEffect } from "react";
import PageTitle from "../../components/common/dashboard/PageTitle";
import ThinCard from "../../components/UI/cards/ThinCard";
import { useLoaderData } from "react-router-dom";
import { ToastContainer, toast } from "react-toastify";
import { useDispatch, useSelector } from "react-redux";
import { clearSuccessMessage } from "../../redux/slices/successMessageSlice";
import TeacherCoursesList from "./../../components/course/TeacherCoursesList";

function TeacherCoursesListPage() {
  const data = useLoaderData();
  const dispatch = useDispatch();
  const successMessage = useSelector((state) => state.successMessage.message);
  
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
      <ThinCard title="La liste des années scolaires">
        <TeacherCoursesList courses={data.courses} />
      </ThinCard>
    </Fragment>
  );
}

export default TeacherCoursesListPage;
