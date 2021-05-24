//Exemplo de como as classes (MODEL - DOMAIN) ficariam em Java
public class Cliente{
	private String cpf;
	private String nome;
	private ArrayList<String> telefone;
	private ArrayList<String> email;
	//Gets AND Sets
}

public class Produto{
	private int cod_prod;
	private String nome;
	private double val_unit;
	//Gets AND Sets
}

public class Pedido{
	private int n_pedido;
	private Cliente cliente;
	private Produto produto;
	private int qtd;
	//Métodos
	public double getSubtotal(){}
	//Gets AND Sets
}