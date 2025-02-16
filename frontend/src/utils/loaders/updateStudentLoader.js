import axios from "axios";
import { AppURL } from "../../apis/AppURL";
import { getAuthToken } from "../loaders";

export const updateStudentLoader = async ({ params }) => {
  const authToken = getAuthToken();

  try {
    const [groupsResponse, studentResponse] = await Promise.all([
      axios.get(AppURL.allGroups(), {
        headers: {
          Authorization: `Bearer ${authToken}`,
        },
      }),
      axios.get(AppURL.manageStudent(params.id), {
        headers: {
          Authorization: `Bearer ${authToken}`,
        },
      }),
    ]);

    const groupsData = groupsResponse.data;
    const studentData = studentResponse.data;

    return { groups: groupsData.groups, student: studentData.student };
  } catch (error) {
    console.error("Erreur lors de la récupération des données des niveaux ou des matières:", error);
    throw new Error("Échec du chargement des données des niveaux ou des matières.");
  }
};
