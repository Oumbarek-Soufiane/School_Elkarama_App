import React, { useState } from "react";
import axios from "axios";
import MUIDataTable from "mui-datatables";
import { HiOutlineTrash } from "react-icons/hi";
import { AppURL } from "../../apis/AppURL";
import { getAuthToken } from "./../../utils/loaders/authLoader";
import Swal from "sweetalert2";
import { toast } from "react-toastify";

const ContactList = ({ contacts }) => {
  const [messageList, setMessages] = useState(contacts || []);
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
        await axios.delete(AppURL.manageConatct(id), {
          headers: {
            Authorization: `Bearer ${authToken}`,
          },
        });
        setMessages(contacts.filter((message) => message.id !== id));
        toast.success("Le message a été supprimé avec succès.");
      } catch (error) {
        console.error("Erreur lors de la suppression du message:", error);
        Swal.fire(
          "Erreur!",
          "Une erreur est survenue lors de la suppression.",
          "error"
        );
      }
    }
  };

  const columns = [
    { name: "Prénom", options: { filter: false } },
    { name: "Nom", options: { filter: false } },
    { name: "Téléphone", options: { filter: false } },
    { name: "Email", options: { filter: false } },
    { name: "Message", options: { filter: false } },
    {
      name: "Actions",
      options: {
        filter: false,
        customBodyRender: (value, tableMeta) => {
          const messageId = contacts[tableMeta.rowIndex].id;
          return (
            <button
              className="btn btn-sm btn-danger"
              onClick={() => handleDelete(messageId)}
            >
              <HiOutlineTrash />
            </button>
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
        title={"Liste des messages"}
        data={messageList.map((message) => [
          message.contact_first_name,
          message.contact_last_name,
          message.contact_telephone,
          message.contact_email,
          message.message,
        ])}
        columns={columns}
        options={options}
      />
    </div>
  );
};

export default ContactList;
