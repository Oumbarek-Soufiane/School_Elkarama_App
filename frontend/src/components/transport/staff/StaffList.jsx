import React, { useState } from "react";
import axios from "axios";
import { Link } from "react-router-dom";
import MUIDataTable from "mui-datatables";
import { HiOutlinePencilSquare } from "react-icons/hi2";
import { HiOutlineTrash } from "react-icons/hi";
import { getAuthToken } from "../../../utils/loaders";
import { AppURL } from "../../../apis/AppURL";
import Swal from "sweetalert2";
import { toast } from "react-toastify";

const StaffList = ({ staff }) => {
  const [staffList, setStaffList] = useState(staff || []);
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
        await axios.delete(AppURL.manageTransportStaff(id), {
          headers: {
            Authorization: `Bearer ${authToken}`,
          },
        });
        setStaffList(staffList.filter((item) => item.id !== id));
        toast.success("Le personnel de transport a été supprimé avec succès.");
      } catch (error) {
        console.error(
          "Erreur lors de la suppression du personnel de transport :",
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
    { name: "CIN", options: { filter: false } },
    { name: "Prénom", options: { filter: false } },
    { name: "Nom", options: { filter: false } },
    { name: "Date de naissance", options: { filter: false } },
    { name: "Bus", options: { filter: false } },
    {
      name: "Actions",
      options: {
        filter: false,
        customBodyRender: (value, tableMeta, updateValue) => {
          const staffId = staffList[tableMeta.rowIndex].id;
          return (
            <div>
              <Link
                to={`/admin/transport-staff/${staffId}/edit`}
                className="btn btn-sm btn-primary mr-1"
              >
                <HiOutlinePencilSquare />
              </Link>
              <button
                className="btn btn-sm btn-danger"
                onClick={() => handleDelete(staffId)}
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
        title={"Liste du personnel de transport"}
        data={staffList.map((staff) => [
          staff.cin,
          staff.first_name,
          staff.last_name,
          staff.date_of_birth,
          staff.bus ? staff.bus.registration_number : "Aucun Bus",
        ])}
        columns={columns}
        options={options}
      />
    </div>
  );
};

export default StaffList;
