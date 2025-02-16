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

const ClassRoomList = ({ rooms = [] }) => {
  const [roomList, setRoomList] = useState(rooms);
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
        await axios.delete(AppURL.manageClassRoom(id), {
          headers: {
            Authorization: `Bearer ${authToken}`,
          },
        });
        setRoomList(roomList.filter((room) => room.id !== id));
        toast.success("La salle a été supprimée avec succès.");
      } catch (error) {
        console.error("Erreur lors de la suppression de la salle:", error);
        Swal.fire(
          "Erreur!",
          "Une erreur est survenue lors de la suppression.",
          "error"
        );
      }
    }
  };

  const columns = [
    { name: "Numero", options: { filter: false } },
    { name: "Description", options: { filter: false } },
    { name: "Capacité", options: { filter: false } },
    { name: "Type", options: { filter: false } },
    { name: "Disponibilité", options: { filter: false } },
    {
      name: "Actions",
      options: {
        filter: false,
        customBodyRender: (value, tableMeta, updateValue) => {
          const roomId = roomList[tableMeta.rowIndex].id;
          return (
            <div>
              <Link
                to={`/admin/class-rooms/${roomId}/edit`}
                className="btn btn-sm btn-primary mr-1"
              >
                <HiOutlinePencilSquare />
              </Link>
              <button
                className="btn btn-sm btn-danger"
                onClick={() => handleDelete(roomId)}
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
        title={"Liste des salles"}
        data={roomList.map((room) => [
          room.number,
          room.description,
          room.capacity,
          room.type,
          room.availability ? "Disponible" : "Non disponible",
        ])}
        columns={columns}
        options={options}
      />
    </div>
  );
};

export default ClassRoomList;
