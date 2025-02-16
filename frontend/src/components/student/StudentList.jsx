import React, { useState } from "react";
import axios from "axios";
import { Link } from "react-router-dom";
import MUIDataTable from "mui-datatables";
import { HiEye , HiOutlineTrash } from "react-icons/hi";
import { AppURL } from "../../apis/AppURL";
import { getAuthToken } from "./../../utils/loaders/authLoader";
import Swal from "sweetalert2";
import { toast } from "react-toastify";

const StudentList = ({ students }) => {
  const [studentList, setStudentList] = useState(students);
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
        await axios.delete(AppURL.manageStudent(id), {
          headers: {
            Authorization: `Bearer ${authToken}`,
          },
        });
        setStudentList(studentList.filter((student) => student.id !== id));
        toast.success("L'eleve a été supprimée avec succès.");
      } catch (error) {
        console.error("Erreur lors de la suppression de l'eleve :", error);
        Swal.fire(
          "Erreur!",
          "Une erreur est survenue lors de la suppression.",
          "error"
        );
      }
    }
  };

  const columns = [
    { name: "Prenom", options: { filter: false } },
    { name: "Nom", options: { filter: false } },
    { name: "Genre", options: { filter: false } },
    { name: "Tuteur", options: { filter: false } },
    {
      name: "Actions",
      options: {
        filter: false,
        customBodyRender: (value, tableMeta, updateValue) => {
          const studentId = students[tableMeta.rowIndex].id;
          return (
            <div>
              <Link
                to={`/admin/students/${studentId}/details`}
                className="btn btn-sm btn-primary mr-1"
              >
                <HiEye />
              </Link>
              <button
                className="btn btn-sm btn-danger"
                onClick={() => handleDelete(studentId)}
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
        title={"Student List"}
        data={studentList.map((student) => [
          student.student_first_name,
          student.student_last_name,
          student.student_gender,
          student.guardian.guardian_first_name,
        ])}
        columns={columns}
        options={options}
      />
    </div>
  );
};

export default StudentList;
