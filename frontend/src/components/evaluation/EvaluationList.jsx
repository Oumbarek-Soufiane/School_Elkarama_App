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

const EvaluationList = ({ evaluations }) => {
  const [evaluationList, setEvaluationList] = useState(evaluations);
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
        await axios.delete(AppURL.manageEvaluation(id), {
          headers: {
            Authorization: `Bearer ${authToken}`,
          },
        });
        setEvaluationList(
          evaluationList.filter((evaluation) => evaluation.id !== id)
        );
        toast.success("L'évaluation a été supprimée avec succès.");
      } catch (error) {
        console.error("Erreur lors de la suppression de l'évaluation :", error);
        Swal.fire(
          "Erreur!",
          "Une erreur est survenue lors de la suppression.",
          "error"
        );
      }
    }
  };

  const columns = [
    { name: "Enseignant", options: { filter: false } },
    { name: "Groupe", options: { filter: false } },
    { name: "Sujet", options: { filter: false } },
    { name: "Année scolaire", options: { filter: false } },
    { name: "Numéro d'évaluation", options: { filter: false } },
    {
      name: "Actions",
      options: {
        filter: false,
        customBodyRender: (value, tableMeta, updateValue) => {
          const evalId = evaluationList[tableMeta.rowIndex].id;
          return (
            <div>
              <Link
                to={`/admin/evaluations/${evalId}/edit`}
                className="btn btn-sm btn-primary mr-1"
              >
                <HiOutlinePencilSquare />
              </Link>
              <button
                className="btn btn-sm btn-danger"
                onClick={() => handleDelete(evalId)}
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
        title={"Liste des évaluations"}
        data={evaluationList.map((evaluation) => [
          evaluation.teacher.teacher_first_name +
            " " +
            evaluation.teacher.teacher_last_name,
          evaluation.group.name,
          evaluation.subject.name,
          evaluation.school_year.name,
          evaluation.evaluation_number,
        ])}
        columns={columns}
        options={options}
      />
    </div>
  );
};

export default EvaluationList;
