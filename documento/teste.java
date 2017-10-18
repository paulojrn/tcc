public retornaLista (){
	ArrayList<String> listPalavras = new ArrayList<String>();
	ArrayList<Integer> listQuantidade = new ArrayList<Integer>();
	while(lerProximaPalavra()!=null){
		String p = lerProximaPalavra();
		for(String s:listPalavras){
			if(s.equals(p))
				listQuantidade.addAt(listPalavras.indexOf(p), listQuantidade.indexOf(p)++);
		}else{
			listPalavras.add(p);
			listQuantidade.addAt(listPalavras.indexOf(p), 1);
		}
	}
}