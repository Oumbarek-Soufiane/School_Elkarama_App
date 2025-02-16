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


const BusList = ({ buses }) => {
  const [busList, setBusList] = useState(buses || []);
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
        await axios.delete(AppURL.manageBus(id), {
          headers: {
            Authorization: `Bearer ${authToken}`,
          },
        });
        setBusList(busList.filter((bus) => bus.id !== id));
        toast.success("Le bus a été supprimé avec succès.");
      } catch (error) {
        console.error("Erreur lors de la suppression du bus :", error);
        Swal.fire(
          "Erreur!",
          "Une erreur est survenue lors de la suppression.",
          "error"
        );
      }
    }
  };

  const columns = [
    { name: "Numéro d'immatriculation", options: { filter: false } },
    { name: "Capacité de sièges", options: { filter: false } },
    {
      name: "Actions",
      options: {
        filter: false,
        customBodyRender: (value, tableMeta, updateValue) => {
          const busId = busList[tableMeta.rowIndex].id;
          return (
            <div>
              <Link
                to={`/admin/buses/${busId}/edit`}
                className="btn btn-sm btn-primary mr-1"
              >
                <HiOutlinePencilSquare />
              </Link>
              <button
                className="btn btn-sm btn-danger"
                onClick={() => handleDelete(busId)}
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
        title={"Liste des bus"}
        data={busList.map((bus) => [bus.registration_number, bus.seating_capacity])}
        columns={columns}
        options={options}
      />
    </div>
  );
};

export default BusList;
