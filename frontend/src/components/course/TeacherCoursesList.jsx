import React, { useState } from "react";
import axios from "axios";
import { Link } from "react-router-dom";
import MUIDataTable from "mui-datatables";
import { HiOutlinePencilSquare } from "react-icons/hi2";
import { HiOutlineTrash } from "react-icons/hi";
import Swal from "sweetalert2";
import { toast } from "react-toastify";
import { AppURL } from "../../apis/AppURL";
import { getAuthToken } from "./../../utils/loaders/authLoader";

const TeacherCoursesList = ({ courses }) => {
  const [courseList, setCourseList] = useState(courses || []);
  const authToken = getAuthToken();

  const handleDelete = async (id) => {
    const result = await Swal.fire({
      title: "Êtes-vous sûr?",
      text: "Vous ne pourrez pas revenir en arrière après cette action!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Oui, supprimer!",
      cancelButtonText: "Annuler",
    });

    if (result.isConfirmed) {
      try {
        await axios.delete(AppURL.manageCourse(id), {
          headers: {
            Authorization: `Bearer ${authToken}`,
          },
        });
        setCourseList(courseList.filter((course) => course.id !== id));
        toast.success("Le cours a été supprimé avec succès.");
      } catch (error) {
        console.error("Erreur lors de la suppression du cours :", error);
        Swal.fire(
          "Erreur!",
          "Une erreur est survenue lors de la suppression.",
          "error"
        );
      }
    }
  };

  const columns = [
    { name: "Nom du cours", options: { filter: false } },
    { name: "Matière", options: { filter: false } },
    { name: "Groupe", options: { filter: false } },
    { name: "Type", options: { filter: false } },
    {
      name: "Actions",
      options: {
        filter: false,
        customBodyRender: (value, tableMeta, updateValue) => {
          const courseId = courseList[tableMeta.rowIndex].id;
          return (
            <div>
              <Link
                to={`/teacher/courses/${courseId}/edit`}
                className="btn btn-sm btn-primary mr-1"
              >
                <HiOutlinePencilSquare />
              </Link>
              <button
                className="btn btn-sm btn-danger"
                onClick={() => handleDelete(courseId)}
              >
                <HiOutlineTrash />
              </button>
            </div>
          );
        },
      },
    },
  ];

  const options = {
    filterType: "checkbox",
  };

  return (
    <div>
      <MUIDataTable
        title={"Liste des cours"}
        data={courseList.map((course) => [
          course.course_name,
          course.subject.name,
          course.group.name,
          course.type,
        ])}
        columns={columns}
        options={options}
      />
    </div>
  );
};

export default TeacherCoursesList;
