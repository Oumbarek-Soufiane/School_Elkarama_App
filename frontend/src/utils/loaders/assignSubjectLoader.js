import axios from "axios";
import { AppURL } from "../../apis/AppURL";
import { getAuthToken } from "../loaders";

export const assignSubjectsLoader = async () => {
  const authToken = getAuthToken();

  try {
    const [levelsResponse, subjectsResponse] = await Promise.all([
      axios.get(AppURL.allLevels(), {
        headers: {
          Authorization: `Bearer ${authToken}`,
        },
      }),
      axios.get(AppURL.allSubjects(), {
        headers: {
          Authorization: `Bearer ${authToken}`,
        },
      }),
    ]);

    const levelsData = levelsResponse.data;
    const subjectsData = subjectsResponse.data;

    return { levels: levelsData.levels, subjects: subjectsData.subjects };
  } catch (error) {
    console.error("Error fetching levels or subjects data:", error);
    throw new Error("Failed to load levels or subjects data.");
  }
};
