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

const AdminList = ({ admins }) => {
  const [adminList, setAdminList] = useState(admins);
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
        await axios.delete(AppURL.manageAdmin(id), {
          headers: {
            Authorization: `Bearer ${authToken}`,
          },
        });
        setAdminList(adminList.filter((admin) => admin.id !== id));
        toast.success("L'administrateur a été supprimé avec succès.");
      } catch (error) {
        console.error(
          "Erreur lors de la suppression de l'administrateur :",
          error
        );
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
    { name: "Prénom", options: { filter: false } },
    { name: "CIN", options: { filter: false } },
    {
      name: "Actions",
      options: {
        filter: false,
        customBodyRender: (value, tableMeta, updateValue) => {
          const adminId = adminList[tableMeta.rowIndex].id;
          const isAdminSuperAdmin = adminList[tableMeta.rowIndex].role === 'super_admin';

          return (
            <div>
              <Link
                to={`/admin/admins/${adminId}/edit`}
                className="btn btn-sm btn-primary mr-1"
              >
                <HiOutlinePencilSquare />
              </Link>
              {!isAdminSuperAdmin && (
                <button
                  className="btn btn-sm btn-danger"
                  onClick={() => handleDelete(adminId)}
                >
                  <HiOutlineTrash />
                </button>
              )}
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
        title={"Liste des administrateurs"}
        data={adminList.map((admin) => [
          admin.last_name,
          admin.first_name,
          admin.cin,
        ])}
        columns={columns}
        options={options}
      />
    </div>
  );
};

export default AdminList;
