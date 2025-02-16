import React, { useState } from "react";
import axios from "axios";
import { Link } from "react-router-dom";
import MUIDataTable from "mui-datatables";
import { HiOutlinePencilSquare } from "react-icons/hi2";
import { HiOutlineTrash } from "react-icons/hi";
import { AppURL } from "../../apis/AppURL";
import { getAuthToken } from "./../../utils/loaders/authLoader";
import Swal from "sweetalert2";
import { toast } from "react-toastify";

const TeacherList = ({ teachers }) => {
  const [teacherList, setTeacherList] = useState(teachers);
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
        await axios.delete(AppURL.manageTeacher(id), {
          headers: {
            Authorization: `Bearer ${authToken}`,
          },
        });
        setTeacherList(teacherList.filter((teacher) => teacher.id !== id));
        toast.success("Le professeur a été supprimé avec succès.");
      } catch (error) {
        console.error("Erreur lors de la suppression du professeur :", error);
        Swal.fire(
          "Erreur!",
          "Une erreur est survenue lors de la suppression.",
          "error"
        );
      }
    }
  };

  const columns = [
    { name: "Nom", options: { filter: false } },
    { name: "Prenom", options: { filter: false } },
    { name: "CIN", options: { filter: false } },
    {
      name: "Actions",
      options: {
        filter: false,
        customBodyRender: (value, tableMeta, updateValue) => {
          const teacherId = teacherList[tableMeta.rowIndex].id;
          return (
            <div>
              <Link
                to={`/admin/teachers/${teacherId}/edit`}
                className="btn btn-sm btn-primary mr-1"
              >
                <HiOutlinePencilSquare />
              </Link>
              <button
                className="btn btn-sm btn-danger"
                onClick={() => handleDelete(teacherId)}
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
        title={"Liste des professeurs"}
        data={teacherList.map((teacher) => [
          teacher.teacher_last_name,
          teacher.teacher_first_name,
          teacher.teacher_cin,
        ])}
        columns={columns}
        options={options}
      />
    </div>
  );
};

export default TeacherList;
