const getSPT = async () => {
    try {
        const response = await axios.get(location.origin + "/api/tanah");
        return response.data;
    } catch (err) {
        console.error(err);
    }
};
