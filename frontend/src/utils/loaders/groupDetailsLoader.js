import axios from "axios";
import { AppURL } from "../../apis/AppURL";
import { getAuthToken } from "./../../utils/loaders/authLoader";

export async function groupDetailsLoader({ params }) {
  const authToken = getAuthToken();

  try {
    const [groupResponse, studentsResponse] = await Promise.all([
      axios.get(AppURL.manageGroup(params.id), {
        headers: {
          Authorization: `Bearer ${authToken}`,
        },
      }),
      axios.get(AppURL.allGroupStudents(params.id), {
        headers: {
          Authorization: `Bearer ${authToken}`,
        },
      }),
    ]);

    const groupData = groupResponse.data;
    const studentsData = studentsResponse.data;

    return { group: groupData.group, students: studentsData.students };
  } catch (error) {
    console.error(
      "Erreur lors de la récupération des données du groupe ou des sections :",
      error
    );
    throw new Error(
      "Échec du chargement des données du groupe ou des sections."
    );
  }
}
