import React, { useState } from "react";
import axios from "axios";
import { Link } from "react-router-dom";
import MUIDataTable from "mui-datatables";
import { HiOutlinePencilSquare } from "react-icons/hi2";
import { HiOutlineTrash } from "react-icons/hi";
import { AppURL } from "../../apis/AppURL";
import { getAuthToken } from "./../../utils/loaders/authLoader";
import Swal from "sweetalert2";
import { toast } from 'react-toastify';

const SchoolYearList = ({ years }) => {
  const [yearList, setYearList] = useState(years);
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
        await axios.delete(AppURL.manageSchoolYear(id), {
          headers: {
            Authorization: `Bearer ${authToken}`,
          },
        });
        setYearList(yearList.filter((year) => year.id !== id));
        toast.success("L'année scolaire a été supprimée.")
      } catch (error) {
        console.error("Erreur lors de la suppression de l'année scolaire:", error);
        Swal.fire("Erreur!", "Une erreur est survenue lors de la suppression.", "error");
      }
    }
  };

  const columns = [
    { name: "Libellé", options: { filter: false } },
    { name: "Description", options: { filter: false } },
    { name: "Statut", options: { filter: false } },
    {
      name: "Actions",
      options: {
        filter: false,
        customBodyRender: (value, tableMeta, updateValue) => {
          const yearId = yearList[tableMeta.rowIndex].id;
          return (
            <div>
              <Link
                to={`/admin/school-years/${yearId}/edit`}
                className="btn btn-sm btn-primary mr-1"
              >
                <HiOutlinePencilSquare />
              </Link>
              <button
                className="btn btn-sm btn-danger"
                onClick={() => handleDelete(yearId)}
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
        title={"Liste des années scolaires"}
        data={yearList.map((year) => [year.name, year.description, year.status])}
        columns={columns}
        options={options}
      />
    </div>
  );
};

export default SchoolYearList;
