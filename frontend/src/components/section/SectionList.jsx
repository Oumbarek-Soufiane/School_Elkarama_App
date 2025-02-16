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

const SectionList = ({ sections }) => {
  const [sectionList, setSectionList] = useState(sections);
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
        await axios.delete(AppURL.manageSection(id), {
          headers: {
            Authorization: `Bearer ${authToken}`,
          },
        });
        setSectionList(sectionList.filter((section) => section.id !== id));
        toast.success("La section a été supprimée avec succès.");
      } catch (error) {
        console.error("Erreur lors de la suppression de la section :", error);
        Swal.fire(
          "Erreur!",
          "Une erreur est survenue lors de la suppression.",
          "error"
        );
      }
    }
  };

  const columns = [
    { name: "Libellé", options: { filter: false } },
    { name: "Niveau", options: { filter: false } },
    { name: "Description", options: { filter: false } },
    { name: "Frais par Mois", options: { filter: false } },
    {
      name: "Actions",
      options: {
        filter: false,
        customBodyRender: (value, tableMeta, updateValue) => {
          const sectionId = sectionList[tableMeta.rowIndex].id;
          return (
            <div>
              <Link
                to={`/admin/sections/${sectionId}/edit`}
                className="btn btn-sm btn-primary mr-1"
              >
                <HiOutlinePencilSquare />
              </Link>
              <button
                className="btn btn-sm btn-danger"
                onClick={() => handleDelete(sectionId)}
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
        title={"Liste des sections"}
        data={sectionList.map((section) => [
          section.name,
          section.level.name,
          section.school_fees_per_month,
        ])}
        columns={columns}
        options={options}
      />
    </div>
  );
};

export default SectionList;
