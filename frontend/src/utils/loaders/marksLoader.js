import axios from "axios";
import { AppURL } from "../../apis/AppURL";
import { getAuthToken } from "../loaders";

export const marksLoader = async () => {
  const authToken = getAuthToken();

  try {
    const [yearsResponse, marksResponse] = await Promise.all([
      axios.get(AppURL.allStudentSchoolYears(), {
        headers: {
          Authorization: `Bearer ${authToken}`,
        },
      }),
      axios.get(AppURL.studentmarks(), {
        headers: {
          Authorization: `Bearer ${authToken}`,
        },
      }),
    ]);

    const yearsData = yearsResponse.data;
    const marksData = marksResponse.data;
// console.log(marksData.evaluations);
    return { years: yearsData.years, marks: marksData.evaluations };
  } catch (error) {
    console.error("Error fetching years or marks data:", error);
    throw new Error("Failed to load years or marks data.");
  }
};
