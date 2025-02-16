import axios from "axios";
import { AppURL } from "../../apis/AppURL";
import { getAuthToken } from "../loaders";

export const teacherGoupsAndSubjectsLoader = async () => {
  const authToken = getAuthToken();

  try {
    const [groupsResponse, subjectsResponse, evaluationsResponse] = await Promise.all([
      axios.get(AppURL.teacherGroups(), {
        headers: {
          Authorization: `Bearer ${authToken}`,
        },
      }),
      axios.get(AppURL.teacherSubjects(), {
        headers: {
          Authorization: `Bearer ${authToken}`,
        },
      }),
      axios.get(AppURL.teacherEvaluations(), {
        headers: {
          Authorization: `Bearer ${authToken}`,
        },
      })
    ]);

    const groupsData = groupsResponse.data;
    const subjectsData = subjectsResponse.data;
    const evaluationsData = evaluationsResponse.data;

    return {
      groups: groupsData.groups,
      subjects: subjectsData.subjects,
      evaluations: evaluationsData.evaluations
    };
  } catch (error) {
    console.error("Erreur lors de la récupération des données des groupes, des matières ou des évaluations :", error);
    throw new Error("Échec du chargement des données des groupes, des matières ou des évaluations.");
  }
};
