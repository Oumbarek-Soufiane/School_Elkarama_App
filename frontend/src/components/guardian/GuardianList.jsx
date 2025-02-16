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

const GuardianList = ({ guardians }) => {
  const [guardianList, setGuardianList] = useState(guardians || []);
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
        await axios.delete(AppURL.manageGuardian(id), {
          headers: {
            Authorization: `Bearer ${authToken}`,
          },
        });
        setGuardianList(guardianList.filter((guardian) => guardian.id !== id));
        toast.success("Le tuteur a été supprimé avec succès.");
      } catch (error) {
        console.error("Erreur lors de la suppression du tuteur :", error);
        Swal.fire(
          "Erreur!",
          "Une erreur est survenue lors de la suppression.",
          "error"
        );
      }
    }
  };

  const columns = [
    { name: "Cin", options: { filter: false } },
    { name: "Nom", options: { filter: false } },
    { name: "Email", options: { filter: false } },
    { name: "Téléphone", options: { filter: false } },
    {
      name: "Actions",
      options: {
        filter: false,
        customBodyRender: (value, tableMeta, updateValue) => {
          const guardianId = guardianList[tableMeta.rowIndex].id;
          return (
            <div className="d-none">
              <Link
                to={`/admin/guardians/${guardianId}/edit`}
                className="btn btn-sm btn-primary mr-1"
              >
                <HiOutlinePencilSquare />
              </Link>
              <button
                className="btn btn-sm btn-danger"
                onClick={() => handleDelete(guardianId)}
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
    selectableRows: "none",
  };

  return (
    <div>
      <MUIDataTable
        title={"Liste des tuteurs"}
        data={guardianList.map((guardian) => [
          guardian.guardian_cin,
          guardian.guardian_first_name + " " + guardian.guardian_last_name,
          guardian.guardian_email,
          guardian.guardian_phone,
        ])}
        columns={columns}
        options={options}
      />
    </div>
  );
};

export default GuardianList;
